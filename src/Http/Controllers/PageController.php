<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Abstracts\Repositories\ProfileAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\Profile;

#[\Attribute]

class PageController
{
    public function __construct(
        private readonly EmailAbstractRepository $emailRepository,
        private readonly ProfileAbstractRepository $profileRepository,
        private readonly UserAbstractRepository $userRepository,
    ) {}

    public function index(): mixed
    {
        return render('index');
    }

    public function mail(): mixed
    {
        if (!auth()->user()) {
            redirect('/login');
        }
        $emails = $this->emailRepository->fetchAll();
        return render('mail', compact('emails'));
    }

    public function about(): mixed
    {
        return render('about');
    }

    /**
     * @param int $code
     * @param string $message
     * @return mixed|void
     */
    public function error(int $code, string $message)
    {
        /**
         * we don't use the render fn here, just
         * in case the error is thrown within
         */
        try {
            return require __DIR__ . "/../../Views/error/errors.view.php";
        } catch (\Throwable $e) {
            echo "<p>{$e->getMessage()}</p>";
            echo "<p>{$e->getTraceAsString()}</p>";
        }
    }

    public function profile()
    {
        if(!auth()->isUserLoggedIn()) {
            setFlashMessages(["danger" => "No user logged in"]);
            redirect("/login");
        }
        return render('profile', [
            'profile' => $this
                ->userRepository
                ->getLoggedUser()
                ->getProfile(),
        ]);
    }

    /**
     * @return mixed|void
     */
    public function storeProfile()
    {
        if(!auth()->isUserLoggedIn()) {
            setFlashMessages(["danger" => "No user logged in"]);
            redirect("/login");
        }
        if (post("address") && files("image")["error"] == UPLOAD_ERR_OK) {
            try {
                $fullPath = STORAGE_PATH . "/" . files("image")["full_path"];
                $profile = $this->createProfile($fullPath);

                move_uploaded_file(files("image")["tmp_name"], $fullPath);

                setFlashMessages(["success" => "Your profile has been updated"]);
                return render("profile", compact("profile"));
            } catch(\Throwable $e) {
                setFlashMessages(["danger" => $e->getMessage()]);
                redirect("/profile");
            }
        } else {
            if(
                !files("image") ||
                files("image")["error"] == UPLOAD_ERR_NO_FILE
            ) {
                setFlashMessages(["danger" => "Are you sure you uploaded a file?"]);
            } else if (files("image")["error"] == UPLOAD_ERR_OK) {
                setFlashMessages(["danger" => "There was a problem uploading the file"]);
            }
            redirect("/profile");
        }
    }

    private function createProfile(string $fullPath): Profile {
        $profile = new Profile();
        $profile->setImagePath($fullPath);
        $profile->setAddress(post('address'));
        $this->profileRepository->save($profile);
        return $profile;
    }
}
