define([
    'Magento_Ui/js/form/form',
    'Magento_Checkout/js/Model/step-navigator',
    'mage/translate',
    'underscore'
],function(Component,stepNavigator,$t,_){
    'use strict';
    return Component.extend({
        defaults:{
            template:'ThemeDev_Checkout/contact',
            visible:true
        },
        initialize:function(){
            this._super();
            stepNavigator.registerStep(
                'contact',
                'contact',
                $t('contact'),
                this.visible,
                _.bind(this.navigate,this),
                this.sortOrder
            );
        },
        initObservable:function(){
            this._super().observe(['visible']);
            return this;
        },
        navigate:function(step){
            step && step.isVisible(true);
        },
        setContactInformation:function(){
            //validate
            //form submission
            stepNavigator.next();
        }
    });
});
