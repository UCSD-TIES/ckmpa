'use strict'

(angular.module 'ckmpa.filters', []).filter 'interpolate', ['version', (version) -> (text) -> (String text).replace //\%VERSION\%//g, version]