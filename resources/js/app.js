import Vue from "vue";
import VueMeta from "vue-meta";
import PortalVue from "portal-vue";
import { App, plugin } from "@inertiajs/inertia-vue";
import { InertiaProgress } from "@inertiajs/progress";

Vue.config.productionTip = false;
Vue.mixin({ methods: { route: window.route } });
Vue.use(App);
Vue.use(PortalVue);
Vue.use(VueMeta);

InertiaProgress.init();

const el = document.getElementById("app");

new Vue({
    metaInfo: {
        titleTemplate: title =>
            title ? `${title} - Hyangla Inc` : "Hyangla Inc"
    },
    render: h =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(el);
