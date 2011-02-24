Ext.ns('MyApp');


MyApp.AppPanel = Ext.extend(Ext.Panel, {
    title  : 'Address Manager',
    layout : 'border',
    initComponent : function() {
        this.items = this.buildItems();

        MyApp.AppPanel.superclass.initComponent.call(this);
    },
    buildItems : function() {
        return [
            {
                xtype  : 'MyApp.ContactListPanel',
                region : 'west',
                width  : 300
            },
            {
                xtype  : 'MyApp.ContactFormPanel',
                region : 'center',
                bbar   : [
                    {
                        text    : 'New',
                        scope   : this,
                        handler : this.onNewBtn
                    },
                    {
                        text    : 'Save',
                        scope   : this,
                        handler : this.onSaveBtn
                    },
                    '->',
                    {
                        text    : 'Delete',
                        scope   : this,
                        handler : this.onDeleteBtn
                    }
                ]
            }
        ];
    },
    onNewBtn : function() {

    },
    onSaveBtn : function() {

    },
    onDeleteBtn : function() {

    }
});

Ext.reg('MyApp.AppPanel', MyApp.AppPanel);