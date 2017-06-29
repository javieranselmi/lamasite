function Metrics(){
}

Metrics.prototype.publishMetric = function(name, value, type, resourceType, resourceId){
    $.post(laroute.route('metric_post'),{name: name, value: value, type: type, resource_type: resourceType, resource_id: resourceId} ,function(data){
        if(data.status == 'success'){
            console.log('metric published');
        }
    });
};

Metrics.prototype.publishProductVisit = function(product_id){
    this.publishMetric('visit', null, 'counter', 'App\\Product', product_id);
};


