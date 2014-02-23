'use strict'

app = angular.module 'ckmpa.filters', []

app.filter "hasNumericField" -> 
	(categories) ->
		categories |> filter (.fields |> any (.type=="number") )
