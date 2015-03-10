package entities;

import entities.ContainerEntity;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2015-01-24T12:25:19")
@StaticMetamodel(CircuitEntity.class)
public class CircuitEntity_ { 

    public static volatile ListAttribute<CircuitEntity, ContainerEntity> containers;
    public static volatile SingularAttribute<CircuitEntity, Long> id;
    public static volatile SingularAttribute<CircuitEntity, Boolean> state;

}