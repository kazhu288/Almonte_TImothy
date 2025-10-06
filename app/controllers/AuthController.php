<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    public function login()
    {
        if ($this->io->method() === 'post') {
            $email = trim($this->io->post('email'));
            $password = (string)$this->io->post('password');

            $user = $this->UserModel->verifyCredentials($email, $password);
            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => isset($user['role']) ? $user['role'] : 'user',
                ]);
                redirect('users/view');
                return;
            }
            $data['error'] = 'Invalid email or password.';
            $this->call->view('auth/login', $data);
        } else {
            $this->call->view('auth/login');
        }
    }

    public function register()
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $email = trim($this->io->post('email'));
            $password = (string)$this->io->post('password');
            $password_confirm = (string)$this->io->post('password_confirm');

            $errors = [];
            if (strlen($username) < 3) { $errors[] = 'Username must be at least 3 characters.'; }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Invalid email.'; }
            if (strlen($password) < 6) { $errors[] = 'Password must be at least 6 characters.'; }
            if ($password !== $password_confirm) { $errors[] = 'Passwords do not match.'; }
            if ($this->UserModel->findByEmail($email)) { $errors[] = 'Email already registered.'; }

            if (!empty($errors)) {
                $data['errors'] = $errors;
                $data['old'] = ['username' => $username, 'email' => $email];
                $this->call->view('auth/register', $data);
                return;
            }

            $now = date('Y-m-d H:i:s');
            $insert = [
                'username' => $username,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_BCRYPT),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ];
            try {
                $this->db->table('users')->insert($insert);
                // Auto-login after register
                $user = $this->UserModel->findByEmail($email);
                if ($user) {
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => isset($user['role']) ? $user['role'] : 'user',
                    ]);
                }
                redirect('users/view');
            } catch (Exception $e) {
                $data['errors'] = ['Registration failed: ' . htmlspecialchars($e->getMessage())];
                $data['old'] = ['username' => $username, 'email' => $email];
                $this->call->view('auth/register', $data);
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
