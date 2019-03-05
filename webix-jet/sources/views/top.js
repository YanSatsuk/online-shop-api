import {JetView, plugins} from "webix-jet";

export default class TopView extends JetView {
    config() {
        return {
            type: "header", template: "Shop", css: "webix_header app_header"
        };
    }

    init() {
        this.use(plugins.Menu, "top:menu");
    }
}
