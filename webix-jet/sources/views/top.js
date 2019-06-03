import {JetView, plugins} from "webix-jet";
import Header from "./header/header";
import Auth from "./auth/auth";

export default class TopView extends JetView {
    config() {
        return {
            rows: [
                Header,
                { $subview: true }
            ]
        };
    }
}
