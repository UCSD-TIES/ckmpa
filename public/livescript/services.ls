app = angular.module 'ckmpa.services', []

mode = 'mobile'
host = if mode == 'mobile' then 'http://ckmpa.gopagoda.com/' else 'localhost'

app.factory 'Auth', ($http, $sanitize, Flash) ->
  sanitizeCredentials = (credentials) ->
    {
      username: $sanitize credentials.username
      password: $sanitize credentials.password
    }
  loginError = (response) -> Flash.show response.flash
  cacheSession = -> sessionStorage.setItem 'authenticated', true
  uncacheSession = -> sessionStorage.removeItem 'authenticated'
  {
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
  }

app.factory 'Flash', ($rootScope) ->
  {
    show: (message) -> $rootScope.flash = message
    clear: -> $rootScope.flash = ''
  }

app.factory 'Users', ($resource) -> $resource host+'api/users/'

app.factory 'Mpas', ($resource) -> $resource host+'api/mpas/'

app.factory 'Datasheets' ($resource) -> $resource host+'api/datasheets'
