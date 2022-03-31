import { UNIT_TYPE } from '../components/interface';
import { ProductType } from '../components/types';

/**
 * Function to combine unit values based on the type of the product, be it a disc, furniture, or book.
 */
export const combineUnits = (
  unit: string,
  unitValue: string,
  type: string
): string => {
  const unitType = UNIT_TYPE[type as ProductType];

  switch (type) {
    case 'DISC':
      return `${unitType}: ${unitValue}${unit}`;
    case 'FURNITURE':
      return `${unitType}: ${unitValue}`;
    case 'BOOK':
      return `${unitType}: ${unitValue}${unit}`;
    default:
      return '';
  }
};
