<script type="text/javascript">
	// import _ from "lodash";
	var numberUtils = require('mout/number');
	export default {
		data(){
			return {

			}
		},
		methods(){},
		props:['data'],
		computed: {
			total(){
				return numberUtils.abbreviate(this.data.total);
			},
			icon(){
				switch(this.data.title){
					case "users":
						return "fa fa-users";
					break;
					case "tracks":
						return "fa fa-play";
					break;
					case "artists":
						return "fa fa-user";
					break;
					case "activeAds":
						return "fa fa-tv";
					break;
				}
			}
		}
	}
</script>

<template>
	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i :class="icon"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{ data.title }}</span>
          <span class="info-box-number">{{ total }}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>
</template>