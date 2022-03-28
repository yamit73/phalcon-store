<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    /**
     * Login action controller
     *
     * @return void
     */
    public function indexAction()
    {
        if ($this->cookies->has('rememberMe')) {
            $this->response->redirect('dashboard');
        }
        $postData = $this->request->getPost();
        $escaper=new \App\Components\MyEscaper();
        $data=$escaper->sanitize($postData);
        if (isset($data['email']) && isset($data['password'])) {
            $user=Users::findFirst(
                [
                    'email = :email: AND password = :password:',
                    'bind' => [
                        'email' => $data['email'],
                        'password' => $data['password'],
                    ],
                ]
            );
            
            if ($user) {
                // die($user->permission);
                if ($user->permission === 'approved') {
                    $this->session->set('id', $user->id);
                    $this->session->set('name', $user->name);
                    $this->session->set('role', $user->role);
                    $this->response->redirect('dashboard');
                    if ($this->request->getPost('remember')==='on') {
                        $this->cookies->set('rememberMe', $user->id, time() + 15*36000);
                        $this->cookies->send();
                    }
                } else {
                    $this->view->message="You don't have permission to login!";
                    $this->loginLogger->error("login Permission Denied!");
                }
            } else {
                $this->view->message="Authentication failed!, wrong credentials";
                // $this->response->setStatusCode(403, 'Wrong Credentials')
                //                 ->setContent("Authentication failed!, wrong credentials");
                $this->loginLogger->error("wrong credentials");
            }
            
        } else {
            $this->view->message='input Field should not be empty';
            $this->loginLogger->error("input Field is empty");
        }
    }
    /**
     * Logout action
     *
     * @return void
     */
    public function logoutAction()
    {
        $this->session->destroy();
        $this->cookies->get('rememberMe')->delete();
        $this->response->redirect('');
    }
}
