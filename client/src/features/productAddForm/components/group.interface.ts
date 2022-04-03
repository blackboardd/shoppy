import { INameModel } from '../models/name';
import { IPriceModel } from '../models/price';
import { ISkuModel } from '../models/sku';
import { IUnitValueModel } from '../models/unitValue';
import { Type } from './group.type';

/**
 * Common form group interface for props.
 *
 * @export
 * @interface IGroupsProps
 */
export interface IGroupProps {
  product: IFormProduct;
  validations: IValidations;
  handlers: IFormHandlers;
}

/**
 * Interface for product form groups.
 *
 * @export
 * @interface IFormGroup
 */
export interface IFormProduct {
  sku: ISkuModel;
  name: INameModel;
  price: IPriceModel;
  type: Type;
  unit: string;
  unitValue: IUnitValueModel;
}

/**
 * Interface for unit values.
 */
export interface IUnitValue {
  DISC: {
    [key: string]: string;
  };
  BOOK: {
    [key: string]: string;
  };
  FURNITURE: {
    [key: string]: string;
  };
}

/**
 * Interface for form handlers.
 *
 * @export
 * @interface IFormHandlers
 */
export interface IFormHandlers {
  sku: (event: React.ChangeEvent<HTMLInputElement>) => void;
  name: (event: React.ChangeEvent<HTMLInputElement>) => void;
  price: (event: React.ChangeEvent<HTMLInputElement>) => void;
  type: (event: React.ChangeEvent<HTMLSelectElement>) => void;
  unitValue: (unitValue: IUnitValue) => void;
}

/**
 * Interface for validations.
 *
 * @export
 * @interface IValidations
 */
export interface IValidations {
  sku: {
    isValid: boolean;
    error: string;
  };
  name: {
    isValid: boolean;
    error: string;
  };
  price: {
    isValid: boolean;
    error: string;
  };
  unitValue: {
    isValid: boolean;
    error: string;
  };
}
