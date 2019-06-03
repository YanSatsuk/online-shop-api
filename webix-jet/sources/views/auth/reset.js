import {JetView} from "webix-jet";

export default class Reset extends JetView {
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
                    labelWidth: 140,
                    labelAlign:"right"
                },
                {
                    paddingX: 140,
                    cols: [
                        {
                            view: "button",
                            value: "Send Password Reset Link",
                            width: 300,
                            type: "form"
                        }
                    ]
                }
            ]
        }
    }
}
