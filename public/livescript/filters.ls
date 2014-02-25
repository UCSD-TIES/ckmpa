'use strict'

app = angular.module 'ckmpa.filters', []

app.filter "hasNumericField" -> 
  (categories, search) ->
    searchFunc = (x)->
      searchString = search.toLowerCase!
      name = x.name.toLowerCase!
      x.type is "number" and name.substring(0,search.length) is searchString
    if not search
      categories |> filter (.fields |> any (.type=="number") )
    else
      categories |> filter (.fields |> any (searchFunc) )

app.filter 'encodeUri' ->
  (x) -> encodeURIComponent x;

