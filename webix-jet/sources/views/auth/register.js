import {JetView} from "webix-jet";

export default class Register extends JetView {
    config() {
        return {
            view: "form",
            paddingY: 150,
            width: 600,
            rules: {
                "username": webix.rules.isNotEmpty,
                "email": webix.rules.isEmail,
                "password": webix.rules.isNotEmpty,
                "password_confirm": webix.rules.isNotEmpty
            },
            elements: [
                {
                    view: "text",
                    label: "Name",
                    name: "username",
                    labelWidth: 140,
                    labelAlign:"right"
                },
                {
                    view: "text",
                    label: "E-mail Address",
                    name: "email",
                    labelWidth: 140,
                    labelAlign:"right"
                },
                {
                    view: "text",
                    type: "password",
                    label: "Password",
                    name: "password",
                    labelWidth: 140,
                    labelAlign:"right"
                },
                {
                    view: "text",
                    type: "password",
                    label: "Confirm Password",
                    name: "password_confirm",
                    labelWidth: 140,
                    labelAlign:"right"
                },
                {
                    paddingX: 140,
                    cols: [
                        {
                            view: "button",
                            value: "Register",
                            width: 100,
                            type: "form",
                            click: this.register
                        }
                    ]
                }
            ]
        }
    }

    register() {
        let form = this.getFormView();
        if (form.validate()) {
            let values = form.getValues();
            this.$scope.app.getService("auth").signup(values).then((res) => {
                let { code, data } = res.json();
                if (code && code == 200) {
                    console.log(data);
                }
            })
        }
    }
}
