Ext.ns('MyApp');

MyApp.ContactListView = Ext.extend(Ext.Panel, {
    html : 'MyApp.ContactFormPanel'
});

Ext.reg('MyApp.ContactListView',MyApp.ContactListView);