<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $user = new Users();
            $postData = $this->request->getPost();
            $escaper=new \App\Components\MyEscaper();
            $data=$escaper->sanitize($postData);

            if (!Users::findFirst('email="'.$data['email'].'"')) {
                if ($data['password'] === $data['confirmPassword']) {
                    $user->assign(
                        $data,
                        [
                            'name',
                            'email',
                            'password'
                        ]
                    );
                    if ($user->save()) {
                        $this->view->message = "User created";
                        $this->response->redirect('login');
                    } else {
                        $this->signupLogger->error("Not created: <br>" . implode("<br>", $user->getMessages()));
                        $this->view->message = "Not created: <br>" . implode("<br>", $user->getMessages());
                    }
                } else {
                    $this->view->message = "Password did not match";
                    $this->signupLogger->error("Password did not match");
                }
            } else {
                $this->view->message = "Email already registered try with different email!";
                $this->signupLogger->error("Email already registered");
            }
        }
            
    }
}
