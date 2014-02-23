app = angular.module 'ckmpa.services', []

mode = 'mobile'
host = if mode == 'mobile' then 'http://ckmpa.gopagoda.com/' else 'localhost'

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
    tallies := [{"name": f.name, "val": switch f.type
    | 'number' => 0
    | 'checkbox' => 'No'
    | 'radio' => f.options[0].name } for f in fields]

  datasheets: datasheets.$promise
  res: res
  categories: -> categories
  fields: -> fields
  tallies: -> tallies
  comments: -> comments
  getTally: (name) -> tallies |> find (.name == name)

app.factory 'Favorites' (Datasheets) ->
  favorites = 
    * name: "Recreation"
      val1: 0
    * name: "Offshore Recreation"
      val1: 0

  favorites: -> favorites
  add: (name) -> 
    if not @get name and favorites.length < 5
      favorites.push do
        name: name 
        val1: 0

  get: (name) -> favorites |> find (.name == name)
  delete: (name) -> 
    i = favorites.map (e) -> e.name 
    .indexOf name
    favorites.splice i,1 unless i < 0


  
  
