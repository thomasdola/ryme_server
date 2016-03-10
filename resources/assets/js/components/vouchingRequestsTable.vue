<template>
	<table class="table table-hover">
	        <thead>
	            <tr>
	                <th>Name</th>
	                <th>Stage Name</th>
	                <th>Categories</th>
	                <th>Days Left</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            <tr v-for="request in requests">
	            <td>{{ request.user.name }}</td>
	            <td>{{ request.user.stage_name }}</td>
	            <td>{{ request.user.categories }}</td>
	            <td>{{ request.end_date }}</td>
	            <td>
	                <button type="button" 
	                	@click="cancelRequest(request, $index)" 
	                	class="btn btn-xs btn-default">
	                    <i class="fa fa-times"></i>
	                </button>
	            </td>
	        </tr>
	        </tbody>
	    </table>
</template>

<script type="text/babel">
	export default {
		props: ['requests'],
		methods: {
			cancelRequest(request, index){
				console.log(request.user, index);
			}
		}
	}
</script>