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
