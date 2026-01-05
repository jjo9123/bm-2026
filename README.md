# Generate UK WP Engine Deployment Tests

This repo is used to test deployments to WP Engine with GitHub Actions, based roughly 
on the approach described at:
https://wpengine.com/builders/branched-deploys-wp-engine-github-actions/

It aims to follow WP Engine's recommended Best Practices for Development Workflows - see:
https://wpengine.com/support/development-workflow-best-practices/

Please see
https://wiki.guk.agency/manual/development-processes/article/wp-engine-development-deployment-workflow
for further information about this workflow, including a summary of its main features and
the associated benefits.

Custom code changes that are made within the `wp-content` folder of this repo should 
automatically get deployed to the WP Engine Deploy Tests website at
https://deploytests.wpenginepowered.com/ (if the current branch is set to `production`) or
https://deploytestsstg.wpenginepowered.com/ (if the current branch is set to `staging`).

In addition, this repo forms a template that can be used to set up future Generate UK WP 
projects that use this mechanism (or similar) to handle code deployments to WP Engine.

The repo can be updated to incorporate any subsequent amendments or enhancements to this
deployment mechanism, and/or any adjustments to the initial file structure of a typical
Generate UK WordPress website, and/or any future refinements to our development workflow
or coding approach.

**Note: This README file is _only_ intended for GitHub administrators at Generate UK, 
and is _not_ for web developer(s) who are working on individual websites that get set up 
based on this repo.**

**Please instead see the [README-REPOS-TEMPLATE.md](README-REPOS-TEMPLATE.md) file for 
details that apply to individual sites that get set up based on this repo.**

## Set-Up Steps for New Site Repositories:

Follow the steps below to set up a _new_ website repository on GitHub, based on this 
`wp-deploy-tests` template repo. The new repo will use a similar mechanism to deploy 
changes to WP Engine.

1. Check the relevant WP Engine environment already exists and includes an _up-to-date_ 
   staging site. If not, set this up in WP Engine.
2. Create a new GitHub repo, using this `wp-deploy-tests` repo as a template.
3. Remove this `README.md` file from the new repo.
4. Rename the `README-REPOS-TEMPLATE.md` file in the new repo to `README.md`. Update the 
   main heading and top paragraph of the new `README.md` file to contain the correct 
   website-specific information.
5. Update the website URL in the 'About' section of the new GitHub repo, on the right-hand
   side.
6. Create a new `production` branch in the new repo.
7. Create a new SSH key in your local terminal application:
   ```
   $ cd .ssh && ssh-keygen -t ed25519 -f wpengine_github_deploy_[sitename] -C wpengine_github_deploy_[sitename]
   ```
8. Go to https://my.wpengine.com/profile/ssh_keys and create/add the _public_ key that 
   was generated on your computer.
9. Update the repo settings as follows:
   - _Settings > General_:  
     * Disable: Allow squash merging or rebase merging
     * Enable: Automatically delete head branches
     * Enable: Include Git LFS objects in archives.
   - _Settings > Secrets > Actions_: Add a new `WPE_SSHG_KEY_PRIVATE` secret to the repo, 
     containing the _private_ key that was generated on your computer.
   - _Settings > Secrets > Actions > Variables_: Add 2 new `WPE_ENV_PRODUCTION` and 
     `WPE_ENV_STAGING` variables to the repo - these should contain the correct WP Engine 
     environment names for the relevant site.
10. Inform the developer(s) who will be working on the site that the new repo is ready 
    for them to start working on, and that they should now follow the steps in the 
    [Getting Started](README-REPOS-TEMPLATE.md#getting-started) section of the new 
    repo's README file.

## Set-Up Steps for Adapting Existing Site Repositories:

Follow the steps below to adapt an _existing_ GitHub repository for a site hosted on WP 
Engine, to use the new deployment workflow as well as to incorporate the various other 
custom modifications contained within this `wp-deploy-tests` template repo.

1. Check whether any other developers are actively working on the site, and/or if there
   is any major outstanding functionality that is due to launch on the site soon. If so,
   it may be better to wait until another time... Ask them to commit & push any 
   uncommitted code to the repo.
2. Check if the existing GitHub repo for the relevant website has any branches containing
   unfinished or unneeded changes; merge and/or delete these if appropriate.
3. Rename the `master` or `main` branch of the existing GitHub repo for this site to
   `staging`; ensure this is set to the default branch. Create a new `production` branch.
4. Check the relevant WP Engine environment already exists and includes an _up-to-date_ 
   staging site. If not, set this up in WP Engine.
5. Pull the current `staging` environment from WP Engine to a local PC, using the
   [Local WP](https://localwp.com/) software. Check that the Local website loads 
   successfully when you visit it.
6. Stop the Local site running, and ensure its files are not open in any other software.
7. Rename the `<local-site-location>/app/public/` folder to 
   `<local-site-location>/app/public.backup/`.
8. Clone the existing GitHub repo for the relevant website into the 
   `<local-site-location>/app/public/` folder.
9. Move/copy the contents of the `<local-site-location>/app/public.backup/` folder into
   `<local-site-location>/app/public/`, overwriting all files where applicable. This 
   should ensure the repo includes any files from the live site that were not already 
   added to the Git repo. _Note: if you are using a Mac, you may need to
   [use the `ditto` command](https://osxdaily.com/2010/08/12/merge-directories-in-mac-os-x/)
   to merge the contents of these 2 folders together._
10. Clone this separate `wp-deploy-tests` template repo from GitHub into a temporary new 
    folder.
11. Move/copy all the files from the temporary folder created in step 10 _(except for the 
    hidden `.git` folder inside it)_ into `<local-site-location>/app/public/`, overwriting 
    all files where applicable (as per step 9).
12. Within the updated repo, review the old and new versions of the `.gitignore` file:
     - If the old website-specific version of the file includes any custom locations that
       need to be excluded or included in the repo, add these to the new version of 
       the `.gitignore` file.
     - Check the `wp-content` folder (and any other locations where applicable), to see
       if there are any custom plugins, custom themes, custom language files and/or custom
       MU plugin files that need to be included in the repo. Add these to the new 
       version of the `.gitignore` file.
13. Run the commands below in your terminal application. This should remove any files that
    are now specified in the `.gitignore` file from the git repo, but without physically 
    deleting them from the filesystem, whilst retaining the history of all files that 
    still need to be retained (see: https://stackoverflow.com/a/34435207):
    ```
    $ git rm -r --cached .
    $ git add .
    ```
14. Revert and/or roll back any modifications to the `.htaccess` file or any of the icon
    files in the site root - the existing site-specific versions of these files should
    take priority over the versions of these files in the `wp-deploy-tests` template repo.
15. Review the `README.md` file:
    - If the existing repo already contained a `README.md` file containing 
      website-specific developer instructions, merge the original version of the file with 
      the contents of `README-REPOS-TEMPLATE.md`, update the main heading and top
      paragraph of the updated `README.md` file to contain the correct website-specific
      information, then delete the `README-REPOS-TEMPLATE.md` file from the repo. 
    - If not, simply delete this `README.md` file, rename the `README-REPOS-TEMPLATE.md` 
      file to `README.md`, and update the main heading and top paragraph of the new 
      `README.md` file to contain the correct website-specific information.
16. Create a new SSH key in your local terminal application:
    ```
    $ cd .ssh && ssh-keygen -t ed25519 -f wpengine_github_deploy_[sitename] -C wpengine_github_deploy_[sitename]
    ```
17. Go to https://my.wpengine.com/profile/ssh_keys and create/add the _public_ key that
    was generated on your computer.
18. Update the repo settings as follows:
     - _Settings > General_:  
       * Disable: Don't allow squash merging or rebase merging
       * Enable: Automatically delete head branches
       * Enable: Include Git LFS objects in archives.
     - _Settings > Secrets > Actions_: Add a new `WPE_SSHG_KEY_PRIVATE` secret to the 
        repo, containing the _private_ key that was generated on your computer.
     - _Settings > Secrets > Actions > Variables_: Add 2 new `WPE_ENV_PRODUCTION` and
       `WPE_ENV_STAGING` variables to the repo - these should contain the correct WP 
       Engine environment names for the relevant site.
19. Commit & push all new & changed files to the `staging` branch, and check that 
    deployment completes successfully.
20. Inform developer(s) that the updated repo is ready for them to work on, and 
    that they should now follow the steps in the 
    [Getting Started](README-REPOS-TEMPLATE.md#getting-started) section of the repo's
    README file. _(N.B. To avoid any conflicts with existing versions of the repo on 
    their computer, they are better off cloning a new version of the repo from GitHub, and 
    working with this new version moving forward.)_

## Further Resources

 * [Zoho Learn - Development & Deployment Workflow - Further Details](https://wiki.guk.agency/manual/development-processes/article/wp-engine-development-deployment-workflow)
 * [Zoho Learn - Slides from the December 2023 Training Workshop](https://wiki.guk.agency/manual/development-processes/article/wp-engine-dev-deploy-workflow-slides-dec-2023)
 * [WP Engine - Branched Deploys with GitHub Actions](https://wpengine.com/builders/branched-deploys-wp-engine-github-actions/)
 * [WP Engine - Development Workflow Best Practices](https://wpengine.com/support/development-workflow-best-practices/)