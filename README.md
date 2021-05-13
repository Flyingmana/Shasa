# Shasa
php tools for kubernetes



Scripts I use to play around with kubernetes and tekton.

## make cluster available via http
````
kubectl proxy
````

## setup Dashbopard

helm repo add kubernetes-dashboard https://kubernetes.github.io/dashboard/
helm install my-release kubernetes-dashboard/kubernetes-dashboard

Get the Kubernetes Dashboard URL by running:
```
  export POD_NAME=$(kubectl get pods -n default -l "app.kubernetes.io/name=kubernetes-dashboard,app.kubernetes.io/instance=my-release" -o jsonpath="{.items[0].metadata.name}")
  echo https://127.0.0.1:8443/
  kubectl -n default port-forward $POD_NAME 8443:8443
```


### Ingress setup

kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v0.46.0/deploy/static/provider/cloud/deploy.yaml


### flux

for when you want to automatically update the cluster from Git
Probably not wise or needed to do for local only experiments

* https://fluxcd.io/docs/get-started/

````
brew install fluxcd/tap/flux
````

### concourse-ci
"Concourse is an open-source continuous thing-doer."

 * https://concourse-ci.org/

Setup: 
````
helm repo add concourse https://concourse-charts.storage.googleapis.com/
helm install my-concourse concourse/concourse
brew install homebrew/cask/fly
````

access:
````
kubectl get pods --namespace default -l "app=my-concourse-web" -o jsonpath="{.items[0].metadata.name}"
````

```
    export POD_NAME=$(kubectl get pods --namespace default -l "app=my-concourse-web" -o jsonpath="{.items[0].metadata.name}")
    echo "Visit http://127.0.0.1:8080 to use Concourse"
    kubectl port-forward --namespace default $POD_NAME 8080:8080
```

needs to download the fly cli from the dashboard

````
fly -t tutorial login -c http://localhost:8080 -u test -p test
````


### Tekton Todos

build examples for
 * usecase of reusable pipelines for different repositories.
 * time triggered pipelines
 * reusable tasks
 * how to checkout code for a pipeline and multiple steps

### Infrabox

 * https://www.infrabox.net/#features
 * https://github.com/SAP/infrabox

seems to only run on Google Cloud?
Has a nice Dashboard and UI
