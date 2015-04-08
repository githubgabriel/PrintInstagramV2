(function ( $ ) {

    /**
     *	Plugin Jquery para selecionar multiplos checkboxs
     *   Graças a Jesus Cristo
     *	@author Gabriel A. Barbosa <tx.gabrielbarbosa@gmail.com>
     *	@version 1.0.0
     */
    $.fn.checkAllBox = function( options ) {


        /**
         *	Settings Default
         */
        var settings = $.extend({
            forceChecked: null,
            checkBoxDiv: "input[type=checkbox]",
            debug: false,
            eventChecked: function(obj) {
                debugx("Event: eventChecked Iniciado..!");
            },
            eventUnChecked: function(obj) {
                debugx("Event: eventUnChecked Iniciado..!");
            }
        }, options);

        /**
         *	Function para escrever no console.log
         */
        debugx = function(text) {
            if(settings.debug) {
                console.log(text);
            }
        }
        debugx("========= checkAllBox ========= init()");


        /**
         *	Seta valor de todos checkbox (True or False)
         */
        setAllCheckBox = function (obj, valor) {
            debugx("function setAllCheckBox(this, " + valor + ");");
            if(valor) {
                $(obj).each(function(){ $(this).prop("checked", valor); });
            } else {
                $(obj).each(function(){  $(this).prop("checked", valor);  });
            }
        }

        /**
         *	Init das operações
         */
        $(this).click(function() {

            /**
             *	Pega status do botão principal
             *  Pega tagName e tagType do This
             */

            var tagName = $(this).prop("tagName");
            var tagType = $(this).prop("type");

            var isChecked = ($(this).prop("checked")) ? true : false;

            if(tagName == "INPUT" && tagType == "checkbox") {
               if(isChecked) { isChecked = false; } else {  isChecked = true; }
            }

            debugx("this.prop(checked) =  " + isChecked);
            if(!isChecked) {
                $(this).prop("checked",true);
                isChecked = true;
            } else {
                $(this).prop("checked",false);
                isChecked = false;
            }
            debugx("var isChecked = "+isChecked);

            if(settings.forceChecked != null) {
                if(settings.forceChecked) {
                    setAllCheckBox(settings.checkBoxDiv, true);
                    settings.eventChecked(this);
                } else {
                    setAllCheckBox(settings.checkBoxDiv, false);
                    settings.eventUnChecked(this);
                }
            } else if(isChecked) {
                setAllCheckBox(settings.checkBoxDiv, true);
                settings.eventChecked(this);
            } else {
                setAllCheckBox(settings.checkBoxDiv, false);
                settings.eventUnChecked(this);
            }


        });

    };

}( jQuery ));