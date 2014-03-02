'use strict'

app = angular.module 'ckmpa.filters', []

app.filter "hasNumericField" -> 
  (categories, search) ->
    searchFunc = (x)->
      searchString = search.toLowerCase!
      name = x.name.toLowerCase!
      x.type is "number" and name.substring(0,search.length) is searchString
    if not search
      _.filter categories, (x) -> _.any x.fields, (.type is "number")
    else
      _.filter categories, (x) -> _.any x.fields, searchFunc

