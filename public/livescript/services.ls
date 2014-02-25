app = angular.module 'ckmpa.services', []

mode = 'production'
host = if mode == 'production' then 'http://ckmpa.gopagoda.com/' else 'http://localhost/'

app.factory 'Auth', ($http, $sanitize, Flash) ->
  sanitizeCredentials = (credentials) ->
    username: $sanitize credentials.username
    password: $sanitize credentials.password

  loginError = (response) -> Flash.show response.flash
  cacheSession = -> sessionStorage.setItem 'authenticated', true
  uncacheSession = -> sessionStorage.removeItem 'authenticated'
  
  login: (credentials) ->
    login = $http.post host+'api/auth', sanitizeCredentials credentials
    login.success cacheSession
    login.success Flash.clear
    login.error loginError
    login
  logout: ->
    logout = $http.get host+'api/auth'
    logout.success uncacheSession
    logout
  isLoggedIn: -> sessionStorage.getItem 'authenticated'
  

app.factory 'Flash', ($rootScope) ->
  show: (message) -> $rootScope.flash = message
  clear: -> $rootScope.flash = ''

app.factory 'Users', ($resource) -> $resource host+'api/users/'

app.factory 'Mpas', ($resource) -> $resource host+'api/mpas/'

app.factory 'Datasheets' ($resource) -> 
  res = $resource host+'api/datasheets'
  categories = []
  fields = []
  tallies = []
  comments = []

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

app.factory 'Favorites' (Datasheets) ->
  favorites = []

  datasheets = Datasheets.datasheets.then (data) ->
    favorites.push (Datasheets.fields! |> find (.name is "Recreation"))
    favorites.push (Datasheets.fields! |> find (.name is "Offshore Recreation"))

  favorites: -> favorites
  add: (field) ->
    if not @get field and favorites.length < 5
      favorites.push field

  get: (field) -> favorites |> find ((x) -> x is field)
  delete: (name) -> 
    i = favorites.map (e) -> e.name 
    .indexOf name
    favorites.splice i,1 unless i < 0


  
  
