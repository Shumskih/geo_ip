export const GeoData =
    {
        data(): [] {
            return {}
        },

        props: {
            data: {
                type: Array,
                default: []
            },
        },

        template: `
            <div class="alert alert-light" role="alert">
              <template v-for="(value, index) in data" :key="index">
                <div><b>Город:</b> {{value.city ? value.city : '---' }}</div>
                <div><b>Регион:</b> {{value.region ? value.region : '---' }}</div>
                <div><b>Страна:</b> {{value.country ? value.country : '---' }}</div>
              </template>
            </div>
        `
    };