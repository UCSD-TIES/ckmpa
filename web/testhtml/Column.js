Ext.require('Ext.chart.*');
Ext.require(['Ext.Window', 'Ext.layout.container.Fit', 'Ext.fx.target.Sprite']);

Ext.onReady(function () {
Ext.define('User', {
    extend: 'Ext.data.Model',
    fields: ['id', 'datasheetentry', 'totalTally']
});

var storeTemp = Ext.create('Ext.data.Store', {
    model: 'User',
    proxy: {
        type: 'ajax',
        url : 'users.json',
        reader: {
            type: 'json'
        }
    }
});
    var store = Ext.create('Ext.data.JsonStore', {
    fields: ['name', 'data'],
    data: [
      //{ 'name': 'Resting Leisure',   'data':36 },
        //{ 'name': 'Active or Sporting Leisure',   'data': 20 },
        { 'name': 'Walking or Running', 'data': 8 },
        { 'name': 'Picnic or Grilling',  'data': 6 },
        { 'name': 'Domestic Animals',  'data':8 }
    ]
});

	Ext.create('Ext.chart.Chart', {
	    renderTo: Ext.getBody(),
	    width: 500,
	    height: 300,
	    animate: true,
	    store: store,
	    axes: [
	        {
	            type: 'Numeric',
	            position: 'left',
	            fields: ['data'],
	            label: {
	                renderer: Ext.util.Format.numberRenderer('0,0')
	            },
	            title: 'Count Aggregate',
	            grid: true,
	            minimum: 0
	        },
	        {
	            type: 'Category',
	            position: 'bottom',
	            fields: ['name'],
	            title: 'Activities Recorded'
	        }
	    ],
	    series: [
	        {
	            type: 'column',
	            axis: 'left',
	            highlight: true,
	            tips: {
	              trackMouse: true,
	              width: 140,
	              height: 28,
	              renderer: function(storeItem, item) {
	                this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data'));
	              }
	            },
	            label: {
	              display: 'insideEnd',
	              'text-anchor': 'middle',
	                field: 'data',
	                renderer: Ext.util.Format.numberRenderer('0'),
	                orientation: 'vertical',
	                color: '#333'
	            },
	            xField: 'name',
	            yField: 'data'
	        }
	    ]
	});
});
