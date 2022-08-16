function initVue()
{
	logFunctionCall();

	window.vAPP = new Vue({
	    el: '#app',
	    data: {
	        select2_options: {
	            language: appLang ?? 'pl',
	            placeholder: ' --- ',
	            allowClear: true
	        },

	        toastrOptions: {
	            timeOut: 10000,
	            "showDuration": "2500",
	            "hideDuration": "2500",
	            "progressBar": true,
	            "newestOnTop": true,
	        },

	        productionRealization: {

	        },
	    },

	    watch: {
	    },

	    // define methods under the `methods` object
	    // `this` inside methods points to the Vue instance
	    methods: {
	    	showLoader: function(duration = 400)
	    	{
				$('#loading-wrapper').slideDown(duration);
	    	},

			hideLoader: function(duration = 400)
			{
			    $('#loading-wrapper').slideUp(duration);
			},

			toggleLoader: function(duration = 400)
			{
			    $('#loading-wrapper').slideToggle(duration);
			},

			toastWarning: function(body, title)
			{
			    toastr.warning(body, title, this.toastrOptions);
			},

			toastError: function(body, title)
			{
			    toastr.error(body, title, this.toastrOptions);
			},

			toastSuccess: function(body, title)
			{
			    toastr.success(body, title, this.toastrOptions);
			},

			toastInfo: function(body, title)
			{
			    toastr.info(body, title, this.toastrOptions);
			},
	    },

	    mounted: function() {
	    }
	});
}
