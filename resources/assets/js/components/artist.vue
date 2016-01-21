<template>
	<img :src="avatar" alt="Artist Image">
	<a class="users-list-name" href="#">{{ artist.name }}</a>
	<!-- <span class="users-list-date">Today</span> -->
</template>

<script type="text/javascript">
	export default{
		props:['artist'],
		computed:{
			avatar(){
				return this.artist.photo.photo.path;
			}
		}
	}
</script>