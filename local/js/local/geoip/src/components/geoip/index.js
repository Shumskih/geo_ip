import {Error} from '../error';
import {GeoData} from '../geoData';

export const GeoIp =
    {
        components: {
            Error,
            GeoData
        },

        data(): [] {
            return {
                ip: '',
                geoData: [],
                errors: [],
                requestInProcess: false,
            }
        },

        computed: {
            hasErrors(): boolean {
                return this.errors.length > 0;
            },
            hasGeoData(): boolean {
                return this.geoData.length > 0;
            }
        },

        methods: {
            handleSubmit() {
                if (this.requestInProcess) {
                    return;
                }

                this.requestInProcess = true;
                this.resetErrors();
                this.resetGeoData();

                if (this.ip.trim().length < 1) {
                    this.requestInProcess = false;
                    this.errors.push({'message': 'Не указан ip адрес!'});

                    return;
                }

                this.request();
            },

            request(): void {
                let self = this;

                BX.ajax.runComponentAction(
                    'vendor:geoip',
                    'getIpInfo', {
                        mode: 'ajax',
                        data: {ip: self.ip}
                    }
                ).then(function (response) {
                    self.requestInProcess = false;

                    if (
                        typeof response === 'object'
                        && response?.status
                        && response.status === 'success'
                    ) {
                        self.setGeoData([response?.data]);
                    }
                }).catch(error => {
                    self.requestInProcess = false;

                    if (
                        error?.errors
                        && error?.errors.length > 0
                    ) {
                        self.setErrors(error?.errors)
                    }
                });
            },

            setGeoData(data): void {
                this.geoData = data;
            },

            resetGeoData(): void {
                this.geoData = [];
            },

            setErrors(errors): void {
                this.errors = errors;
            },

            resetErrors(): void {
                this.errors = [];
            },

            validateInput(): void {
                this.ip = this.ip.replace(/[^\d.]/g, '');
            }
        },

        template: `
            <div class="w-50 mt-5">
                <form class="input-group mb-3" @submit.prevent="handleSubmit">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Укажите IP-адрес"
                        v-on:input="validateInput"
                        v-model="ip"
                        >
                    <button 
                        class="btn btn-outline-secondary" 
                        type="submit"
                        id="button-addon2"
                    >
                        Показать
                    </button>
                </form>
                <template v-if="hasGeoData">
                   <GeoData :data="geoData" />
                </template>
                <template v-if="hasErrors">
                   <Error :errors="errors" />
                </template>
            </div>
        `
    };