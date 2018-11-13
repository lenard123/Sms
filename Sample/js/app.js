axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
var app = new Vue({
    el: '#app',
    data: {
        number: '',
        message: '',
        status: '',
        response: ''
    },

    methods: {
        submit() {
            var vm = this;
            this.status = 'SENDING'
            axios.post('./send.php', this.getData())
            .then(function(response){
                console.log(response);
                vm.status = response.data.status;
                vm.response = response.data.message;
            })
            .catch(function(error){
                console.log(error);
                vm.status = 'FAILED';
                vm.response = 'An error occured.';
            })
        },

        getData(){
            var data = new FormData();
            data.append('number', this.number);
            data.append('message', this.message);
            return data;
        },

        reset() {
            this.number = '';
            this.message = '';
        }
    }
})