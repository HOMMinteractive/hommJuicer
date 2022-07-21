# This package has moved

This package was rewritten and moved to [https://github.com/HOMMinteractive/hommsocialfeed](https://github.com/HOMMinteractive/hommsocialfeed)

----

# hommjuicer plugin for Craft CMS 3.x

## Juicer Länge

```
craft.hommjuicer.juicer(20) => 20 Einträge
craft.hommjuicer.juicer(5)  =>  5 Einträge
craft.hommjuicer.juicer()   => 15 Einträge (Default)
```

## Beispiel Implementation

```
{% for juicerItem in craft.hommjuicer.juicer() %}

<div class="entry 
{% if juicerItem.hidden == 1 %} hidden {% endif %} 
{% if juicerItem.color %} {{juicerItem.color}} {%else%} bgBeige {% endif %}"> 

{% if currentUser %}
<div class="juicerAdmin">  
<a class="juicerA" href="/actions/hommjuicer/default?external_id={{ juicerItem.external_id }}&action=color1"><span class="color1"></span></a>	
<a class="juicerA" href="/actions/hommjuicer/default?external_id={{ juicerItem.external_id }}&action=color2"><span class="color2"></span></a>	
<a class="juicerA" href="/actions/hommjuicer/default?external_id={{ juicerItem.external_id }}&action=color3"><span class="color3"></span></a>	
<a class="juicerA" href="/actions/hommjuicer/default?external_id={{ juicerItem.external_id }}&action={% if juicerItem.showimg == 0 %}killimg{% else %}showimg{% endif %}"><span class="fal {% if juicerItem.showimg == 0 %}fa-minus-square{% else %}fa-plus-square{% endif %}"></span></a>					
<a class="juicerA" href="/actions/hommjuicer/default?external_id={{ juicerItem.external_id }}&action={% if juicerItem.hidden == 0 %}kill{% else %}show{% endif %}"><span class="fal {% if juicerItem.hidden == 0 %}fa-eye-slash{% else %}fa-eye{% endif %}"></span></a>
</div>
{% endif %}
				
{% if juicerItem.showimg != 1 %} 
{% if juicerItem.video != '' %}
{% set full_url = juicerItem.video %}
<video class="img" width="100%" style="width:100%" controls poster="{{ juicerItem.image }}"><source src="{{ juicerItem.video }}" type="video/mp4"></video>
{% else %}
<a href="{{full_url}}" class="img" title="{{readMore}}" target="_blank">
<img src="{{ juicerItem.image }}" class="" alt="{{readMore}}">
</a>
{% endif %}				
{% endif %}		
				
<div class="text">
{{ juicerItem.message | raw }}
</div>	
</div>

{% endfor %}  


```

## Juicer Admin CSS Beispiel

```
.grid-item .juicerAdmin{
	text-align:right;
	display:block;
	position:absolute;
	padding:10px 20px;
	top:0;
	left:0;
	width:calc(100% - 40px);
	z-index:70;
	background:rgba(0,0,0,0.8);
	color:#fff;	
}
.grid-item .juicerAdmin a{
	display:inline-block;
	padding:0 0 0 10px;
	color:#fff;
}
.grid-item .juicerAdmin a span{
	width:16px;
	height:16px;
	border-radius:16px;
	padding:0;
	margin:0 10px 0 0;
	display:inline-block;
	opacity:1;
}
.grid-item .juicerAdmin a span.green{
	background:#0ada0a;
	border:1px solid #14c514;
}	
.grid-item .juicerAdmin a span.red{
	background:#f71d1d;
	border:1px solid #c51414;
}	
.grid-item .juicerAdmin a span.color1{
	background:#fff;
	border:1px solid #fff;
}	
.grid-item .juicerAdmin a span.color2{
	background:#003c7a;
	border:1px solid #003c7a;
}	
.grid-item .juicerAdmin a span.color3{
	background:#c00b25;
	border:1px solid #c00b25;
}

```

## Farb/Sichtbarkeits-Anpassung per Ajax

```
$('.juicerA').on('click', function(e){
	e.preventDefault();
	var href = $(this).attr('href');
	
	$.ajax({url: href, success: function(result){
       console.log('yes')
    },
	error: function(){
		location.reload();
		}
	});
```

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require /hommjuicer

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for hommjuicer.

