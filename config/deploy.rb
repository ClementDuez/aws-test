
set :application, "aws"
set :repository,  "git@github.com:ClementDuez/aws-test.git"
set :scm,         :git
set :scm_verbose, true

set :deploy_via, :remote_cache
set :deploy_to,  "/var/www/aws"

set :use_sudo,         false
set :interactive_mode, false
set :user,             "admin"

set :shared_files,    [ app_path + "/config/parameters.yml", app_path + "/config/sips/param/pathfile" ]
set :shared_children, [ log_path, "data", "web/uploads" ]

set :writable_dirs,       [ cache_path ]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

set :use_composer,               true
set :dump_assetic_assets,        true
set :normalize_asset_timestamps, false

desc "check production task"
task :check_production do
if stage.to_s == "production"
    puts " \n Are you REALLY sure you want to deploy to production?"
    puts " \n Enter the password to continue\n "
    password = STDIN.gets[0..7] rescue nil
    if password != 'mypasswd'
        puts "\n !!! WRONG PASSWORD !!!"
        exit
        end
    end
end
role :web, "ec2-54-209-95-12.compute-1.amazonaws.com"
role :app, "ec2-54-209-95-12.compute-1.amazonaws.com"
role :db, "ec2-54-209-95-12.compute-1.amazonaws.com", :primary => true 
ssh_options[:keys] = ["~/.ssh/toad.pem"]
before "deploy", "check_production"

after "symfony:cache:warmup", "symfony:doctrine:migrations:migrate"
before "symfony:assetic:dump", "symfony:assets:update_version"
after "deploy", "deploy:cleanup"
after "deploy", "symfony:clear_apc"
after "deploy:rollback:cleanup", "symfony:clear_apc"
