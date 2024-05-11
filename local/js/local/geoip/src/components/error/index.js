export const Error =
    {
        data(): [] {
            return {}
        },

        props: {
            errors: {
                type: Array,
                default: []
            },
        },

        methods: {
        },

        template: `
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">Ошибка!</h4>
              <template v-for="(value, index) in errors" :key="index">
                <p class="error">{{ value.message }}</p>
              </template>
            </div>
        `
    };