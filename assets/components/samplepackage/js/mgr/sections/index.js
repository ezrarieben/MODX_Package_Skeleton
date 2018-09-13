Ext.onReady(function() {
    MODx.load({ xtype: 'samplepackage-page-home'});
});
SamplePackage.page.Home = function(options) {
    options = options || {};
    Ext.applyIf(options,{
        components: [{
            xtype: 'samplepackage-panel-home'
            ,renderTo: 'samplepackage-panel-home-div'
        }]
    });
    SamplePackage.page.Home.superclass.constructor.call(this,options);
};
Ext.extend(SamplePackage.page.Home,MODx.Component);
Ext.reg('samplepackage-page-home',SamplePackage.page.Home);
