SamplePackage.grid.SamplePackage = function(options) {
  options = options || {};
  Ext.applyIf(options, {
    id: 'samplepackage-grid-samplepackage',
    url: SamplePackage.options.connectorUrl,
    baseParams: {
      action: 'mgr/samplepackage/getList'
    },
    fields: ['id', 'name', 'createdon', 'createdby'],
    paging: true,
    remoteSort: true,
    anchor: '97%',
    autoExpandColumn: 'name',
    columns: [{
      header: _('id'),
      dataIndex: 'id',
      sortable: true,
      width: 60,
      hidden: true,
    }, {
      header: _('samplepackage.name'),
      dataIndex: 'name',
      sortable: true,
      width: 100,
      editor: {
        xtype: 'textfield'
      }
    }],
    tbar: [{
      xtype: 'textfield',
      id: 'category-search-filter',
      emptyText: _('samplepackage.cmp.search'),
      width: 200,
      listeners: {
        'change': {
          fn: this.search,
          scope: this
        },
        'render': {
          fn: function(cmp) {
            new Ext.KeyMap(cmp.getEl(), {
              key: Ext.EventObject.ENTER,
              fn: function() {
                this.fireEvent('change', this);
                this.blur();
                return true;
              },
              scope: cmp
            });
          },
          scope: this
        }
      }
    }, {
      xtype: "button",
      id: "category-search-filter-clear",
      cls: "x-form-filter-clear",
      text: _("samplepackage.cmp.filter.clear"),
      listeners: {
        click: {
          fn: this.clearFilter,
          scope: this
        }
      }
    }],
  });
  SamplePackage.grid.SamplePackage.superclass.constructor.call(this, options)
};
Ext.extend(SamplePackage.grid.SamplePackage, MODx.grid.Grid, {
  search: function(tf, nv, ov) {
    var dataStore = this.getStore();
    dataStore.baseParams.query = tf.getValue();
    this.getBottomToolbar().changePage(1);
    this.refresh();
  },
  clearFilter: function(btn, e) {
    var dataStore = this.getStore();
    dataStore.baseParams.query = "";
    Ext.getCmp('category-search-filter').reset();
    this.getBottomToolbar().changePage(1);
    this.refresh();
  }
});
Ext.reg('samplepackage-grid-samplepackage', SamplePackage.grid.SamplePackage);
