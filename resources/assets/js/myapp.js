'use strict';

// -- make sure jQuery has been already loaded
if ( typeof jQuery === "undefined" )
{
    throw new Error("myAPP requires jQuery");
}

function myAPP(options)
{
   // - assign _root and config private variables
    var _root = this;
    var _options = $.extend({
        baseUrl         : '',
        lang            : 'pl',
        dateFormat      : 'YYYY/MM/DD',
        timeFormat      : 'HH:mm',
        dateTimeFormat  : 'YYYY/MM/DD HH:mm',
        loaderSelector  : '#loading-wrapper',
        msgBoxSelector  : '#msg-box'
    }, options || {});

    // -- private methods (no "this")
    _cache = function()
    {
        //this.link = d.querySelector('.link-item');
    }

    _bind = function()
    {
        //this.link.addEventListener('click', this.handleClick, false);
    }

    // -- Some Public Methods
    this.somePublicMethod = function() {
        //some code
        console.log("somePublicMethod");
    }

    this.url = function( uri ) {
        return _options.baseUrl + uri;
    }

    this.get = function(key, value)
    {
        if ( key === undefined ) {
            return value;
        }

        if ( _options[key] !== undefined ) {
            return _options[key];
        }

        return set(key, value);
    }

    this.set = function(key, value)
    {
        if ( key === undefined || value === undefined ) {
            return null;
        }

        _options[key] = value;

        return value;
    }

    this.toggleLoader = function()
    {
        $(_options.loaderSelector).toggle();
    }

    this.showLoader = function()
    {
        $(_options.loaderSelector).fadeIn();
    }

    this.hideLoader = function()
    {
        $(_options.loaderSelector).fadeOut();
    }

    this.showMessage = function(_str_msg, _str_type) {
        // -- jak wiadomosc jest pusta to nic nie wyswietlamy
        if ( _str_msg == '' ) return false;
        
        $(_options.msgBoxSelector).removeClass('info error success warning');
        switch(_str_type) {
            default:
            case 'info':
                $('#msg-box').addClass('info');
            break;
            case 'error':
                $('#msg-box').addClass('error');
            break;
            case 'success':
                $('#msg-box').addClass('success');
            break;
            case 'warning':
                $('#msg-box').addClass('warning');
            break;
        }
    
        $(_options.msgBoxSelector).html(_str_msg).fadeIn(800);
        setTimeout('myAPP.hideMessage();', 5000);
    
        $(_options.msgBoxSelector).click(function(){
            _root.hideMessage();
        });
    }

    this.hideMessage = function() {
        $(_options.msgBoxSelector).fadeOut(800);
    }

    // -- Initializatoin
    var init = function() {
        _cache();
        _bind();

        return _root;
    }
    
    return init();
}
