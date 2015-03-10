package entities;

import entities.AlertEntity;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2015-01-24T12:25:19")
@StaticMetamodel(ContainerEntity.class)
public class ContainerEntity_ { 

    public static volatile ListAttribute<ContainerEntity, AlertEntity> alerts;
    public static volatile SingularAttribute<ContainerEntity, String> address;
    public static volatile SingularAttribute<ContainerEntity, String> lng;
    public static volatile SingularAttribute<ContainerEntity, Long> id;
    public static volatile SingularAttribute<ContainerEntity, Boolean> state;
    public static volatile SingularAttribute<ContainerEntity, String> lat;

}