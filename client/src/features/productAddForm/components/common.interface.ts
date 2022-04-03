import { IFormHandlers, IValidations } from './group.interface';

/**
 * Common form group interface for props.
 *
 * @export
 * @interface ICommonProps
 */
export interface ICommonProps {
  handlers: IFormHandlers;
  validations: IValidations;
  updateSku: (sku: string) => void;
}
