<template>
    <div class="mb-3">
        <label for="username">Social media link <span class="text-muted">(Optional)</span></label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">

                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ selected_soc_network }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" @click="changeSoc" v-for="soc_network in soc_networks" href="#">{{
                        soc_network }}</a>
                </div>
            </div>
            <input id="username" type="text" name="user_soc_link" class="form-control"
                   aria-label="Text input with dropdown button">
            <input type="text" hidden name="soc_network" :value="selected_soc_network"/>
        </div>
    </div>
</template>

<script>
    export default {
        //name: 'InputSocialSelectComponent',
        data() {
            return {
                selected_soc_network: "instagram.com/",
                soc_networks: ["instagram.com/", "facebook.com/", "vk.com/"],
            }
        },
        methods: {
            changeSoc(e) {
                e.preventDefault();
                this.selected_soc_network = e.target.innerHTML;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
