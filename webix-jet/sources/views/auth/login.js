import {JetView} from "webix-jet";

export default class Login extends JetView {
    config() {
        return {
            view: "form",
            paddingY: 150,
            width: 600,
            elements: [
                {
                    view: "text",
                    label: "E-mail Address",
                    name: "email",
                    labelWidth: 120,
                    labelAlign: "right"
                },
                {
                    view: "text",
                    type: "password",
                    label: "Password",
                    name: "password",
                    labelWidth: 120,
                    labelAlign: "right"
                },
                {
                    view: "checkbox",
                    labelRight: "Remember Me",
                    value: 0,
                    css: {"padding-left": "40px;"}
                },
                {
                    paddingX: 120,
                    cols: [
                        {
                            view: "button",
                            value: "Login",
                            width: 100,
                            type: "form"
                        },
                        {
                            template: `<a href="#!/top/reset">Forgot Your Password?</a>`,
                            borderless: true,
                            css: {
                                "line-height": "32px;",
                                "padding-left": "20px;"
                            }
                        }
                    ]
                }
            ]
        }
    }
}
