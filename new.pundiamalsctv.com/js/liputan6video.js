(function(jwplayer){
  var template = function(player, config, div) {
    var _lp6sq;
  	var _lp6gaq;
  	var _lp6gaq_string;
  	var _lp6gaq_event;
  	var _lp6gaq_page;
  	var _intawal=1;
  	var _intdebug=0;
  	var _inttimer=0;
  	var _intinterval=15; // Interval trigger
	var _intsecondtimer=5;  // Satu detik 10 kali trigger
	var _intsecond=0;
	var _lp6ga_exists=0;
	var _lp6s_exists=0;
    
    function setup(evt) {
		console.debug("load : "  + config.vname);	
    		if(typeof config.debug != 'undefined')
    			_intdebug=config.debug;
    		if(typeof config._gaq_string != 'undefined')
    		{
    			_gaq_string=config._gaq_string;
			_lp6gaq_event= _gaq_string+"." + '_trackEvent';
			_lp6gaq_page= _gaq_string+"." + '_trackPageview';
		}
		else
		{
			_lp6gaq_event=  '_trackEvent';
			_lp6gaq_page=  '_trackPageview';
		}
		if(typeof config._gaq !='undefined')
		{
			_lp6ga_exists = 1;
			_lp6gaq=config._gaq;
			_lp6gaq.push([_lp6gaq_event, 'playvideo', 'load', config.vname]);
		}
		
		if(typeof config._lp6s !='undefined')
		{
			_lp6s_exists = 1;
			_lp6sq=config._lp6s;
			_lp6sq.push(['_track','load','video-1']);
		}
		console.debug("load : "  + config.vname+':'+_lp6s_exists);	
		
		if(_intdebug){
			console.debug("load : "  + config.vname);	
		}
			
    };
    
	function lp6video_play(obj)
	{
		console.debug("State: "+obj.oldstate);
   		if(_intawal==1){
   			_intawal=0;
   			if(_lp6ga_exists)
    	      	_lp6gaq.push([_lp6gaq_event, 'playvideo', 'loadplay', config.vname]);
//			_lp6gaq.push([_lp6gaq_page, '/loadplay/'+ config.vname]);
   			if(_lp6s_exists)
				_lp6sq.push(['_track','loadplay','video-1']);
			if(_intdebug)
		      	console.debug('loadplay: '+ config.vname);
      	}
      	else
      	{
			if(obj.oldstate=="PAUSED")
			{
	   			if(_lp6ga_exists)
					_lp6gaq.push([_lp6gaq_event, 'playvideo', 'startplay', config.vname]);
	   			if(_lp6s_exists)
	   			{
	   				console.debug('play: _lp6s');
					_lp6sq.push(['_track','playvideo','video-1']);
				}
	//			_lp6gaq.push([_lp6gaq_page, '/startplay/'+ config.vname]);
				if(_intdebug)
					console.debug("play : "  + config.vname);
			}
      	}

	};
	
	function lp6video_pause(obj)
	{
		console.debug("State: "+obj.oldstate);
		if(obj.oldstate=="PLAYING")
		{
   			if(_lp6ga_exists)
			 	_lp6gaq.push([_lp6gaq_event, 'playvideo', 'pause', config.vname]);
	//		_lp6gaq.push([_lp6gaq_page, '/pause/'+ config.vname]);
  			if(_lp6s_exists)
				_lp6sq.push(['_track','pause','video-1']);
			if(_intdebug)
			 	console.debug('Pause: '+ config.vname);
		 }
	};
	
	function lp6video_complete()
	{
		if(_lp6ga_exists)
		 	_lp6gaq.push([_lp6gaq_event, 'playvideo', 'completed', config.vname]);
//		_lp6gaq.push([_lp6gaq_page, '/completed/'+ config.vname]);
		if(_lp6s_exists)
			_lp6sq.push(['_track','complete','video-1']);
		if(_intdebug)
		 	console.debug('Completed: '+ config.vname);
	};
	
	function lp6video_time(obj)
	{
		var __intwaktu=0;
		if((Math.floor(obj.position) % _intinterval == 0) && Math.floor(obj.position) != _inttimer)
		{
			_inttimer=Math.floor(obj.position);
			_intsecond++;
			
			__intwaktu=Math.floor(_intsecond*10);
   			if(_lp6ga_exists)
			 	_lp6gaq.push([_lp6gaq_event, 'playvideo', 'time'+ Math.floor(obj.position), config.vname ]);
   			if(_lp6s_exists)
				_lp6sq.push(['_track','time'+ Math.floor(obj.position),'video-1']);

//			_lp6gaq.push([_lp6gaq_page, '/time'+ __intwaktu +'/'+ config.vname]);
			if(_intdebug)
			 	console.debug('time'+ Math.floor(obj.position)+': '+ config.vname+":" +obj.position);
		}
	};
	
	function lp6video_playlistitem(obj)
	{
//		alert(obj.index);
		if(_lp6ga_exists)
		 	_lp6gaq.push([_lp6gaq_event, 'playvideo', 'playlist-'+obj.index, config.vname ]);
		if(_lp6s_exists)
			_lp6sq.push(['_track','playlist-'+obj.index,'video-1']);
		if(_intdebug)
		 	console.debug('playlist('+ obj.index+'): '+ config.vname);
	};
		
    player.onReady(setup);
    player.onPlay(lp6video_play);
    player.onPause(lp6video_pause);
    player.onTime(lp6video_time);
    player.onComplete(lp6video_complete);
    player.onPlaylistItem(lp6video_playlistitem);
  };

  jwplayer().registerPlugin('liputan6video', template);

})(jwplayer);
