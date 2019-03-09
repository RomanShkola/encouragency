<template>
    <div class="container container-order">
        <div class="row pt-5 mt-5">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">1</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ data.product.name }}</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">{{ data.product.price }}</span>
                    </li>
                    <li v-if="promo.isValid" class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>{{ promo.code }}</small>
                        </div>
                        <span class="text-success"> -{{ promo.value }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total price</span>
                        <strong>{{ finalPrice }}</strong>
                    </li>
                </ul>

                <div class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="promo.code" value="sth"
                               placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary" @click="applyPromo">Redeem</button>
                        </div>
                        <div class="invalid-feedback" :class="{ 'd-block' : promo.error }">
                            {{ promo.error }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Order</h4>
                <form class="needs-validation" method="post" action="/order/send">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="user_email" v-model="input.email" @input="checkEmail"
                               class="form-control" id="email"
                               placeholder="you@example.com"
                               :class="{'is-invalid' : inputEmailInvalidStyleClass, 'is-valid': isValidEmail }"
                               required>
                        <div class="invalid-feedback" :class="{ 'd-block' : inputEmailInvalidStyleClass }">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="user_name" class="form-control"
                                   :class="{ 'is-valid': input.firstName.length > 0 }" id="firstName" placeholder=""
                                   v-model="input.firstName" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="user_surname" class="form-control"
                                   :class="{ 'is-valid': input.lastName.length > 0 }" id="lastName" placeholder=""
                                   v-model="input.lastName" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <input-social-select-component></input-social-select-component>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" :class="{ 'is-valid': input.address.length > 0 }"
                               name="user_address" id="address" placeholder="1234 Main St"
                               v-model="input.address" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" name="user_address2" id="address2"
                               placeholder="Apartment or suite">
                    </div>

                    <input-country-phone-component :countries="data.countries"
                                                   :calling_codes="data.calling_codes"></input-country-phone-component>
                    <input type="text" hidden name="price_final" :value="finalPrice"/>
                    <input type="text" hidden name="product_name" :value="data.product.name"/>
                    <input type="text" hidden name="applied_promo" :value="promo.code"/>
                    <div class="mb-5"></div>
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: [
            'data'
        ],
        data() {
            return {
                finalPrice: this.data.product.price,
                promo: {code: '', value: '', isValid: false, error: null},
                isPromoCodeValid: false,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                input: {
                    firstName: "",
                    lastName: "",
                    address: "",
                    email: ""
                },
                isValidEmail: false,

            }
        },

        computed: {
            inputEmailInvalidStyleClass: function () {
                return !this.isValidEmail && this.input.email.length > 0
            },
            promoError: function () {
                return this.promo.error.length;
            }

        },
        mounted() {

        },
        methods: {

            applyPromo() {
                console.log(this.promo.code);
                let ref = this; //example how to get value inside get-function after
                axios.get('/promo/apply', {
                    params: {
                        code: this.promo.code,
                        product: this.data.product.name
                    }
                })
                    .then(function (response) {
                        if (response.data.length === 1) {
                            ref.promo.value = response.data[0].value;
                            ref.promo.isValid = true;
                            ref.finalPrice = parseFloat(ref.data.product.price) * (parseFloat(100 - ref.promo.value) / 100);
                            ref.promo.error = null;
                        } else {
                            ref.promo.error = 'Invalid promo code.';
                        }
                    })

                    .catch(function (error) {
                        ref.promo.error = error;
                        console.log(error.message);
                    });

            },

            checkEmail(e) {
                this.input.email = e.target.value;
                let emailPatt = RegExp('.+@(([\\w\\d])+\\.)+[\\w]+$');
                this.isValidEmail = emailPatt.test(this.input.email);
            }
        }
    }
</script>
