<style>
	ul.result__vew{
		z-index: 9999;
		position: absolute;
		width: 90%;
	}
	ul.result__vew li a{
		text-decoration: none;
	}
	.search__btn:hover{
		cursor: pointer;
	}
</style>

<template>
	<div class="input-group col-md-5 col-md-offset-3">
        <div class="row">
        	<div class="col-xs-12">
	        	<div class="input-group">
	        	  	<input type="text" 
	        	  	v-model="searchQuery"
	        	  	@keyup="search | debounce 500"
	        	  	placeholder="search for artists..."
	        	  	class="form-control">
		        	<span class="input-group-addon search__btn" @click="searchWithQuery">
		        	  	<i class="fa fa-search fa-spin"></i>
		    	  	</span>
	        	</div>
        	</div>
        	<div class="col-xs-12" v-if="searchResult">
        		<ul class="list-group result__vew">
        			<li class="list-group-item" v-for="result in searchResult">
        				<a href="#">
        					{{ result.user.name }}
        				</a>
    				</li>
        		</ul>
        	</div>
        </div>
    </div>
</template>

<script type="text/javascript">
	export default {
		data(){
			return {
				searchQuery:"",
				searhResult: []
			}
		},
		methods: {
			search(){
				if(this.searchQuery.trim()){
					console.log(this.searchQuery.trim());
				}
			},
			searchWithQuery(){
				if(this.searchQuery.trim()){
					console.log(this.searchQuery.trim());
					this.searchQuery = "";
				}
			}
		}
	}
</script>