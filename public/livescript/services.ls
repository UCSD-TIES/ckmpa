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
    logout = $http.delete host+'auth'
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
  getTally: (name,sub,cat) -> tallies |> find ((x) -> x.name is name and x.sub is sub and x.category is cat)
  addTally: (tally) -> tallies.push tally
  saveTallies: -> localStorageService.set 'tallies' tallies
  resetTallies: -> localStorageService.remove 'tallies'

app.factory 'Favorites' (Datasheets, localStorageService) ->
  if not favorites = localStorageService.get "favorites"
    favorites = []
    datasheets = Datasheets.datasheets.then (data) ->
      favorites.push (Datasheets.fields! |> find (.name is "Recreation"))
      favorites.push (Datasheets.fields! |> find (.name is "Offshore Recreation"))

  favorites: -> favorites
  save: -> localStorageService.set 'favorites' favorites
  add: (field) ->
    if not @get field and favorites.length < 5
      favorites.push field

  get: (field) -> favorites |> find ((x) -> x is field)
  delete: (name) -> 
    i = favorites.map (e) -> e.name 
    .indexOf name
    favorites.splice i,1 unless i < 0


  
  
