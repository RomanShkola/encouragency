<template>
    <div>
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="user_address" id="address" placeholder="1234 Main St"
                   required>
            <div class="invalid-feedback">
                Please enter your shipping address.
            </div>
        </div>

        <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" name="user_address2" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select id="country" name="user_country" class="custom-select" @change="setPhoneNumberCode" required>
                    <option disabled selected value="">Select country</option>
                    <option v-for="(country, code) in countries" :value="code"> {{ country }}</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="state">State <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="user_state" id="state" placeholder="">
            </div>
            <div class="col-md-3 mb-3">
                <label for="zip">Zip <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="user_zip" id="zip" placeholder="">
            </div>
        </div>
        <div class="mb-3">
            <label for="phone_number">Phone number</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ calling_code }}
                    </button>
                    <div class="dropdown-menu scrollable-menu">
                        <a v-for="(phone_code, country_abbr) in calling_codes"
                           @click="setPhoneNumberCodeLabel" class="dropdown-item" href="#">+{{ phone_code }} ({{
                            country_abbr }})</a>
                    </div>
                </div>

                <input id="phone_number" type="text" name="user_phone_num" class="form-control" required
                       aria-label="Text input with dropdown button">
                <input type="text" hidden name="user_phone_num_code" :value="calling_code"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'InputCountryPhone',
        props: [
            'countries',
            'calling_codes'
        ],

        data() {
            return {
                selectedCountry: '',
                calling_code: '',
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                console.log(this.countries);
            },
            setPhoneNumberCode: function (e) {
                if (e.target.options.selectedIndex > -1) {
                    let countryCodeAbbr = e.target.options[e.target.options.selectedIndex].value;
                    let code = this.calling_codes[countryCodeAbbr];
                    this.calling_code = "+" + code + " (" + countryCodeAbbr + ")";
                }
            },
            setPhoneNumberCodeLabel: function (e) {
                e.preventDefault();
                this.calling_code = e.target.innerHTML;
            }
        }
    }
</script>
