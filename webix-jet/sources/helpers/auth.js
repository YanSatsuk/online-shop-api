import { getCsrfToken } from 'csrfToken';

export default function Auth(app) {
    const post = (url, data) => {
        data['_token'] = getCsrfToken();
        return webix.ajax().post(url, data)
                /*.then(res => res.json())
                .then(res => {
                    console.log(res);
                    if (res.code == 200) {
                        resolve(res);
                    }
                })*/
        //})
    }

    const service = {
        signup(values) {
            return post("/api/auth/signup", values);
        }
    }

    app.setService("auth", service);
}
