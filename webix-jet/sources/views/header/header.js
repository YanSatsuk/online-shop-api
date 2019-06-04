import {JetView} from "webix-jet";

export default class Header extends JetView {
    logo() {
        return {
            view: "label",
            label: "Shop"
        }
    };

    loggedElements() {
        return [
            this.logo(),
            {
                view: "label",
                label: "Hi, " + this.getName() + "!"
            },
            {
                view: "label",
                label: "Logout",
                width: 100
            },
            {
                view: "label",
                label: "History",
                width: 100
            },
            {
                view: "label",
                label: "Bag",
                width: 100
            }
        ];
    }

    elements() {
        return [
            this.logo(),
            {},
            {
                template: `<a href="#!/top/login">Login</a>`,
                borderless: true,
                css: {"line-height": "32px;"},
                width: 100
            },
            {
                template: `<a href="#!/top/register">Register</a>`,
                borderless: true,
                css: {"line-height": "32px;"},
                width: 100
            }
        ];
    }

    config() {
        return {
            view: "toolbar",
            cols: this.elements()
        }
    }

    getName() {
        return "Pidr";
    }
}
