app = angular.module 'ckmpa.services', []

mode = 'production'
host = if mode == 'production' then 'http://ckmpa.gopagoda.com/' else 'http://localhost/'

app.factory 'Auth', ($http, $sanitize, Flash) ->
  var user, token

  sanitizeCredentials = (credentials) ->
    username: $sanitize credentials.username
    password: $sanitize credentials.password

  loginSuccess = (data, status, headers, config) ->
    user := data.user
    token := data.token

    sessionStorage.setItem 'user' data.user
    sessionStorage.setItem 'token' data.token

  loginError = (response) -> Flash.show response.flash

  logoutSuccess = ->
    user := null
    token := null
  
  login: (credentials) ->
    login = $http.post host+'auth', sanitizeCredentials credentials
      .success loginSuccess
      .error loginError

  logout: ->
    logout = $http do
     method: 'delete'
     url: host + 'auth'

    .success logoutSuccess

  user: -> user || sessionStorage.getItem 'user'
  token: -> token || sessionStorage.getItem 'token'

app.factory 'Flash', ($rootScope) ->
  show: (message) -> $rootScope.flash = message
  clear: -> $rootScope.flash = ''

app.factory 'Mpas', ($resource, Auth) -> $resource host+'api/mpas/'

app.factory 'Datasheets' ($resource, localStorageService) -> 
  res = $resource host+'api/datasheets' {}
  categories = []
  fields = []
  comments = []
  if not tallies = localStorageService.get "tallies"
    tallies = []

  datasheets = res.query {}, ->
    categories := datasheets |> map (.categories)  |> flatten
    fields := categories |> map (.fields) |> flatten

  datasheets: datasheets.$promise
  res: res
  categories: -> categories
  fields: -> fields
  tallies: -> tallies
  comments: -> comments
  getTally: (tally) ->
    _.find tallies, (x) ->
      if x.subcategory and tally.subcategory
        x.field.id is tally.field.id and x.subcategory.id is tally.subcategory.id
      else
        x.field.id is tally.field.id

  addTally: (tally) -> tallies.push tally
  saveTallies: -> localStorageService.set 'tallies' tallies
  resetTallies: -> localStorageService.remove 'tallies'

app.factory 'Favorites' (Datasheets, localStorageService) ->
  if not favorites = localStorageService.get "favorites"
    favorites = []
    datasheets = Datasheets.datasheets.then (data) ->
      favorites.push do
        field: _ Datasheets.fields! .find 'name': "Recreation"
        subcategory: _.find Datasheets.categories!,
          (x) -> _ x.fields .flatten! .any 'name':'Recreation'
        .subcategories[1]
        name: "Recreation (Sandy)"

      favorites.push do
        field: _ Datasheets.fields! .find 'name': "Offshore Recreation"
        subcategory: _.find Datasheets.categories!,
          (x) -> _ x.fields .flatten! .any 'name':'Offshore Recreation'
        .subcategories[0]
        name: "Offshore Recreation"

      localStorageService.set 'favorites' favorites

  favorites: -> favorites
  save: -> localStorageService.set 'favorites' favorites
  add: (field,sub) ->
    fav = 
      field: field
      subcategory: sub
      name: field.name + if sub then " ("+sub.name+")" else ""

    favorites.push fav if not _.any favorites, name: fav.name
      
  get: (field) -> favorites |> find ((x) -> x is field)
  delete: (fav) -> _.pull favorites, fav


  
  
