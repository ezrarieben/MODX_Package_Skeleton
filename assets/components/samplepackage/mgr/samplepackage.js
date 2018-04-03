var SamplePackage = function(options) {
    options = options || {};
    SamplePackage.superclass.constructor.call(this,options);
};
Ext.extend(SamplePackage,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},options: {}
});
Ext.reg('samplepackage',SamplePackage);
SamplePackage = new SamplePackage();
