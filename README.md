# hommjuicer plugin for Craft CMS 3.x

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

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require /hommjuicer

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for hommjuicer.

