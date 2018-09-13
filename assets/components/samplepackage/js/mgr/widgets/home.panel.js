SamplePackage.panel.Home = function(options) {
    options = options || {};
    Ext.apply(options,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('samplepackage.management')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,items: [{
                title: _('samplepackage')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+_('samplepackage.management_desc')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                }/*,{
                    xtype: 'samplepackage-grid-samplepackage'
                    ,cls: 'main-wrapper'
                    ,preventRender: true
                }*/]
            }]
            // only to redo the grid layout after the content is rendered
            // to fix overflow components' panels, especially when scroll bar is shown up
            ,listeners: {
                'afterrender': function(tabPanel) {
                    tabPanel.doLayout();
                }
            }
        }]
    });
    SamplePackage.panel.Home.superclass.constructor.call(this,options);
};
Ext.extend(SamplePackage.panel.Home,MODx.Panel);
Ext.reg('samplepackage-panel-home',SamplePackage.panel.Home);
