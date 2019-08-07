<template>

</template>

<script>
    export default {

        mounted() {
            let data = {};
            const inputElementTitle = document.querySelector('.form-control[name="title"]');
            const inputElementType = document.querySelector('.form-control[name="type"]');
            const inputElementBody = document.querySelector('.form-control[name="body"]');
            const elemStatusChange = document.querySelector('[data-status-change]');
            const btnSave = document.querySelector('.save');
            const btnType = document.querySelector('.dropdown-menu.select-type');
            const btnStatus = document.querySelector('.dropdown-menu.select-status');

            const select = function () {
                return {
                    title: inputElementTitle.value,
                    type: inputElementType.value,
                    body: inputElementBody.value,
                };
            };

            btnType.addEventListener('click', (eve) => {
                if (eve.target.getAttribute('data-type')) {
                    data.type = eve.target.getAttribute('data-type');
                    inputElementType.value = data.type;
                }
            });

            btnStatus.addEventListener('click', (eve) => {
                if (eve.target.getAttribute('data-status')) {
                    data.status = eve.target.getAttribute('data-status');
                    console.log(data.status);
                    elemStatusChange.textContent = ' changed to ' + (data.status === '1' ? 'active' : 'deactive')
                }
            });

            btnSave.addEventListener('click', (eve) => {

                axios.post('/chunk/save', Object.assign(data, select()))
                    .then(res => {

                        console.log(res)
                    }).catch(err => {

                        console.log(err)
                    })
            });

        }
    }
</script>
