import "./styles/app.css";
import {JetApp, EmptyRouter, HashRouter } from "webix-jet";
import auth from './helpers/auth';

export default class MyApp extends JetApp{
	constructor(config){
		const defaults = {
			id 		: APPNAME,
			version : VERSION,
			router 	: BUILD_AS_MODULE ? EmptyRouter : HashRouter,
			debug 	: !PRODUCTION,
			start 	: "/top/sections.main.main/sections.main.table",
            routes: {
                "/top/start" : "/top/sections.main.main/sections.main.table",
                "/top/login" : "/top/auth.auth/auth.login",
                "/top/register" : "/top/auth.auth/auth.register",
                "/top/reset" : "/top/auth.auth/auth.reset"
            }
		};

		super({ ...defaults, ...config });

		this.use(auth);
	}
}

if (!BUILD_AS_MODULE){
	webix.ready(() => new MyApp().render() );
}
