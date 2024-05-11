import {BitrixVue} from 'ui.vue3';
import {GeoIp} from './components/geoip';

export class Application
{
    constructor(rootNode): void
    {
        this.rootNode = document.querySelector(rootNode);
    }

    start(): void
    {
        this.attachTemplate();
    }

    attachTemplate(): void
    {
        let application = BitrixVue.createApp({
            name: 'Application',
            components: {
                GeoIp
            },
            template: '<GeoIp/>'
        });
        application.mount(this.rootNode);
    }
}

